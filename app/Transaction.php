<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	// •title (Mr, Mrs, Miss, Dr)
	// •first_name (User‟s first name)
	// •last_name (User‟s last name)
	// •email
	// •phone
	// •payment_method (transfer, credit card or paypal)
	// •card_name (if pay by credit card)
	// •card_number (if pay by credit card)
	// •ccv (if pay by credit card)

    protected $fillable = [
    	'title', 'first_name', 'last_name', 'email', 'phone', 'payment_method', 'card_name', 'card_number', 'ccv'
	];
}
