<?php

namespace App\Console\Commands;

use App\Models\Inspection;
use App\Models\User;
use App\Notifications\InspectionExpiring;
use Illuminate\Console\Command;

class CheckInspectionExpiry extends Command
{
    protected $signature = 'inspections:check-expiry';

    protected $description = 'Notify admins and transport officers of vehicle inspections expiring in 14 days';
    public function handle(): void
    {
        $dueInspections = Inspection::with('vehicle')
            ->where('status', 'valid')
            ->whereNull('expiry_notified_at')
            ->whereBetween('expiry_date', [now()->toDateString(), now()->addDays(14)->toDateString()])
            ->get();

        if ($dueInspections->isEmpty()) {
            $this->info('No inspections due for an expiry notification.');
            return;
        }

        $recipients = User::whereIn('role', ['system_admin', 'transport_officer'])->get();

        foreach ($dueInspections as $inspection) {
            foreach ($recipients as $recipient) {
                $recipient->notify(new InspectionExpiring($inspection));
            }

            $inspection->update(['expiry_notified_at' => now()]);
        }

        $this->info("Sent expiry notifications for {$dueInspections->count()} inspection(s) to {$recipients->count()} recipient(s).");
    }
}
