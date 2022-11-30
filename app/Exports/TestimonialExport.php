<?php

namespace App\Exports;

use App\Models\Testimonial;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TestimonialExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    private $ids;
    public function Ids(array $ids)
{
    $this->ids = $ids;

    return $this;
}

    public function query()
{
    if(is_countable($this->ids)&&count($this->ids)>1){
        return Testimonial::query()->whereIn('id', $this->ids);
    }
    return Testimonial::query();
}
    public function headings(): array
{
    return [
        'Review',
        'Event',
        'User',
        'Rating Stars',
        'Date',
    ];
}
    public function map($testimonial): array
{
    return [
        $testimonial->review_text,
        $testimonial->event_trip_booking->booking_details ?? '',
        $testimonial->user->name.' '.$testimonial->user->lastname,
        ($testimonial->ratings ?? 0).' Star(s)',
        $testimonial->review_date,
    ];
}
}
