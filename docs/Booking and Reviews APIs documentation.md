# Booking and Reviews API Documentation


## Create Booking
**Method:** `POST`
**Endpoint:** `/api/bookings`
**Authentication:**Required
### Body:
```json
"play_ground_id": 1, "start_date_time": "2026-07-20 18:00:00", "end_date_time": "2026-07-20 20:00:00", "payment_method": "cash", "coupon_id": 3 
```
### Validation: 
```php
{'play_ground_id' => 'required|exists:play_grounds,id', 'start_date_time' => 'required|date|after:now', 'end_date_time' => 'required|date|after:start_date_time', 'payment_method' => 'required|in:cash,card', 
'coupon_id' => 'nullable|exists:coupons,id'}
```
### Success Response :
```json
{
    "message": "Booking created successfully.",
    "data": {
        "id": 15,
        "start_date_time": "2026-07-20 18:00:00",
        "end_date_time": "2026-07-20 20:00:00",
        "status": "pending",
        "payment_method": "cash",
        "payment_status": "pending",
        "total_price": 40,
        "play_ground_id": 1,
        "user_id": 7,
        "coupon_id": 3
    }
}
```

### Error Responses:
#### Unauthorized
```json
{ "message": "Unauthenticated." }
```
#### Validation Error
```json
{ "message": "The given data was invalid.", "errors": { "start_date_time": [ "The start date time field is required." ] } }
```
#### Playground Not Found
```json
{ "message": "Playground not found." }
```
### Conflict
```json
{ "message": "The selected time slot is already booked." }
```

## View My Bookings
**Method :** `GET`
**Endpoint:** `/api/bookings`
**Authentication:**Required
**No body
**No validation
### Success Response
```json
{
    "message": "Bookings retrieved successfully.",
    "data": [
        {
            "id": 15,
            "play_ground_id": 1,
            "play_ground_name": " AL-Etihad ",
            "start_date_time": "2026-07-20 18:00:00",
            "end_date_time": "2026-07-20 20:00:00",
            "status": "pending",
            "payment_method": "cash",
            "payment_status": "pending",
            "total_price": 40
        },
        {
            "id": 18,
            "play_ground_id": 3,
            "play_ground_name": "AL-Etihad",
            "start_date_time": "2026-07-22 19:00:00",
            "end_date_time": "2026-07-22 20:00:00",
            "status": "completed",
            "payment_method": "cash",
            "payment_status": "paid",
            "total_price": 20
        }
    ]
}
```
### Error Response
#### Unauthorized
```json
{ "message": "Unauthenticated." }
```

## View Booking Details
**Method:** `GET`
**Endpoint:** `/api/bookings/{id}`
**Authentication:**Required
**No body
**Route Parameter:
    id : Booking ID
**No validation

### Success Response
```json
{
    "message": "Booking details retrieved successfully.",
    "data": {
        "id": 15,
        "play_ground_id": 1,
        "play_ground_name": " AL-Etihad",
        "start_date_time": "2026-07-20 18:00:00",
        "end_date_time": "2026-07-20 20:00:00",
        "status": "pending",
        "payment_method": "cash",
        "payment_status": "pending",
        "total_price": 40,
        "coupon_id": 3,
        "created_at": "2026-07-10 14:30:00"
    }
}
```
### Error Responses
#### Unauthorized
```json
{ "message": "Unauthenticated."}
```
#### Forbidden
```json
{"message": "You are not authorized to view this booking."}
```
#### Not Found
```json
{"message": "Booking not found."}
```

## Cancel Booking
**Method:** `DELETE`
**Endpoint:** `/api/bookings/{id}`
**Authentication:**Required
**No body
**Route Parameter:
    id: Booking ID
**No validation
### Success Response
```json
{
    "message": "Booking cancelled successfully.",
    "data": {
        "id": 15,
        "status": "cancelled",
        "cancelled_at": "2026-07-11 18:30:00"   }
}
```
### Error Responses
#### Unauthorized
```json
{"message": "Unauthenticated."}
```
#### Forbidden
```json
{"message": "You are not authorized to cancel this booking."}
```
#### Not Found
```json
{"message": "Booking not found."}
```
#### Conflict
```json
{"message": "Booking is already cancelled."}
```
#### Conflict
```json
{"message": "Booking can no longer be cancelled."}
```

## Create Review
**Method:** `POST`
**Endpoint:** `/api/reviews`
**Authentication:**Required
### Body:
```json
{ "booking_id": 15, "rating": 5, "comment": "Excellent playground and great service." }
```
### Validation
```php
    'booking_id' => 'required|exists:bookings,id',
    'comment' => 'nullable|string|max:500',
    'rating' => 'required|integer|min:1|max:5',
```
### Success response:
```json
{
    "message": "Review added successfully.",
    "data": {
        "id": 7,
        "booking_id": 15,
        "rating": 5,
        "comment": "Excellent playground and great service."
    }
}
```
### Error Responses
#### Unauthorized
```json
{ "message": "Unauthenticated."}
```
#### Forbidden
```json
{ "message": "You are not allowed to review this booking."}
```
#### Not Found
```json
{"message": "Booking not found."}
```
#### Conflict
```json
{"message": "You have already reviewed this booking."}
```
#### Validation Error

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "rating": [
      "The rating field is required."
    ]
  }
}
```

## View Playground Reviews
**Method:** `GET`
**Endpoint:** `/api/playgrounds/{id}/reviews`
**Authentication:**Not Required 
**No body
**Route Parameter
    id : Playground ID
**No validation
### Success Response
```json
{
    "message": "Reviews retrieved successfully.",
    "data": [
        {
            "id": 1,
            "user": "Ahmed",
            "comment": "Excellent playground.",
            "rating": 5,
            "created_at": "2026-07-10 15:30:00"
        },
        {
            "id": 2,
            "user": "Sara",
            "comment": "Very good, but needs better lighting.",
            "rating": 4,
            "created_at": "2026-07-11 18:20:00"
        }
    ]
}
```
### Error Responses
#### Not Found
```json
{"message": "Playground not found."}
```
## Delete Review
**Method:** `DELETE`
**Endpoint:** `/api/reviews/{id}`
**Authentication:**Required 
**No body
**Route Parameter
    id : Review ID
**No validation
### Success Response
```json
{ "message": "Review deleted successfully."}
```
### Error Responses
#### Unauthorized
```json
{ "message": "Unauthenticated."}
```
#### Forbidden
```json
{"message": "You are not authorized to delete this review."}
```
#### Not Found
```json
{"message": "Review not found."}
```