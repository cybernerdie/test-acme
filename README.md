
# Basket Implementation  
This project provides a `Basket` class that allows you to add products, apply special offers, calculate delivery charges, and compute the total cost.  

## How It Works  

### 1. Initialization  
The `Basket` class is initialized with the following dependencies:  
- **ProductCollection** – Holds the products added to the basket.  
- **DeliveryChargeService** – Calculates the delivery charge based on the basket total.  
- **SpecialOfferDiscountService** – Applies special offers to calculate the discount.  
- **ProductService** – Handles product retrieval.  
- **SpecialOfferRepository** – Provides access to active special offers.  

### 2. Helper Method for Dependency Injection  
A helper method `resolve()` is available to resolve dependencies from the container. This allows you to create an instance of the `Basket` (or any other class) like this:  
```php
$basket = resolve(Basket::class);
```

### 3. Adding a Product  
You can add a product to the basket by calling:  
```php
$basket->add('PRODUCT_CODE');
```
If the product code is invalid, a `ProductNotFoundException` is thrown.  

### 4. Calculating the Total  
You can calculate the total (including discounts and delivery charges) by calling:  
```php
$total = $basket->total();
```
The total is calculated as:  
```ini
TOTAL = (SUBTOTAL - DISCOUNT) + DELIVERY CHARGE
```

## 🎯 Assumptions  
✅ No enums are used to pass data between components.  
✅ No database or models are involved — data is managed in memory.  
✅ The `Money` class is used for handling prices and calculations.  
✅ The `ProductService` and `SpecialOfferRepository` are responsible for fetching product and offer data.  
✅ The `ProductCollection` internally manages product storage and retrieval.  
✅ If no products are added, the total will be `$0.00`.  

## ✅ Example Usage  
```php
$basket = resolve(Basket::class);
$basket->add('PRODUCT_CODE');
$total = $basket->total();

echo $total->formatTo('en_US'); // "$15.99"
```

## 🧪 Running Tests  
To run the tests, use:  
```bash
composer test
```
This runs the PHPUnit tests to validate the basket functionality.  

## 🛠️ Running Static Analysis  
To run static analysis using PHPStan, use:  
```bash
composer analyze
```
This checks the code for type safety and potential issues.  
