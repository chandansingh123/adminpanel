<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Customer\Customer;

class SignUp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The customer instance.
     *
     * @var Customer
     */
    protected $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Sign Up Saral Nilami Application')->view('backend.emails.signup-message') ->with([
            'name' => $this->customer->first_name. ' '. $this->customer->last_name,
        ]);
    }
}
