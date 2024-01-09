 # Pool Booking System

This is a pool booking system that allows users to book pools and make payments. It has a user-friendly interface and is easy to use.

## Features

* Users can book pools by selecting the date, time, and pool they want to book.
* Users can make payments using either IBAN or credit card.
* The system automatically calculates the total price of the booking.
* The system checks if the customer already exists in the database before allowing them to book a pool.

## How to Use

1. To book a pool, select the date, time, and pool you want to book.
2. Enter your customer information, including your name, CPR, and phone number.
3. Choose your payment method, either IBAN or credit card.
4. Enter your payment information.
5. Click the "Proceed" button to complete your booking.

## Code Explanation

The code is written in PHP and uses the Laravel framework.

### Step 1: Define the Routes

The first step is to define the routes for the application. This is done in the `routes/web.php` file.

```php
Route::get('/pool/book', 'PoolController@book')->name('pool.book');
Route::post('/pool/bookaction', 'PoolController@bookaction')->name('pool.bookaction');
Route::get('/pool/removeCartItem/{id}', 'PoolController@removeCartItem')->name('pool.removeCartItem');
```


    
