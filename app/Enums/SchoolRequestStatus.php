<?php
declare(strict_types = 1);
namespace App\Enums;


enum SchoolRequestStatus: string
{
    case Draft = 'draft';
    case Submitted = 'submitted';
    case Cancelled = 'cancelled';
    case InReview = 'in_review';
    case Escalated = 'escalated';
    case Rejected = 'rejected';
    case Completed = 'completed';

    //method to get a description of each status
    public function description(): string
    {
        return match($this) {
            self::Draft => __('The request has been started but not yet submitted by the student.'),
            self::Submitted => __('The request has been submitted by the student and is awaiting processing.'),
            self::Cancelled => __('The request has been cancelled by the student.'),
            self::InReview => __('The request is under review by a staff member.'),
            self::Escalated => __('The request has been escalated to a higher level for special attention.'),
            self::Rejected => __('The request has been rejected.'),
            self::Completed => __('The request has been processed and completed successfully.'),
        };
    }
}
?>



