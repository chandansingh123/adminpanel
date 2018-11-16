<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Bid\Bid;

class BidConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The bid instance.
     *
     * @var Bid
     */
    protected $bid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bid confirmation from Saral Nilami Application')->view('backend.emails.bid-confirmation-message') ->with([
            'bid' => $this->bid,
        ]);
    }
}
