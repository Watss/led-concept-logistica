<?php

namespace App\Jobs;

use App\Mail\ReportMail;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class JobWorker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3000;

    public $report;
    public $start;
    public $emails;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($report, $start, $emails, $user)
    {
        $this->report = $report;
        $this->start = $start;
        $this->emails = $emails ?? [];
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $start = $this->start;
            $end12 = Carbon::create($start)->addMonths(12)->format('Y-m-d');

            if ($this->report) {
                Report::where('id', $this->report->id)->update(['failed' => false, 'generated' => false]);
            } else {
                $this->report = Report::updateOrCreate(
                    [
                        "start" => $start,
                        "end" => $end12,

                    ],
                    [
                        "start" => $start,
                        "end" => $end12,
                        "user_id" => $this->user->id,
                        "generated" => false,
                    ]
                );
            }
            array_push($this->emails, $this->user->email);
            Mail::to($this->emails)->send(new ReportMail($this->report, $this->start, $this->user));

            $this->job->delete();
        } catch (\Throwable $th) {
            Log::alert($this->report);
            Log::error($th->getMessage());
            Report::where('id', $this->report->id)->update(['failed' => true]);
            $this->job->delete();
        }
    }
}
