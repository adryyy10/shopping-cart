# Shopping cart

Shopping cart is an application that allows you to add products to your cart (without adding the same one twice) and to be able to make a 10% discount on your final list

## How can I see it locally?

It is easy to reproduce it locally

Inside our shopping-cart directory open a terminal and write:
```bash
symfony server-start
```
Then with the helps of XAMPP we will initialize our Apache and MySQL

![Alt text](readme-images/001.PNG?raw=true "XAMPP")

And here we have our products:

![Alt text](readme-images/002.PNG?raw=true "Products")

## How the application is structured

For this application I implemented a structural pattern called Hexagonal Architecture which divides the application in 3 main layers and keeps the code separate and understandable:
1. Infrastructure layer --> Here we have all "external" services that need to be as decoupled as possible: Controllers, Repositories...etc.
2. Application layer --> Here we have all our UseCases for the application. I used a CQS principle in order to split the validation of data from the logic of the useCase
3. Domain layer --> Here we have all the business logic: Entities & Interfaces. 

![Alt text](readme-images/003.PNG?raw=true "Structure")

## What is the flow of the application

We start in **/products** route where we can see all of our available products.

![Alt text](readme-images/002.PNG?raw=true "Products")

If we click on **"Add to cart"** we will add a new product and it will be shown in the header when we see the number of products refreshed

![Alt text](readme-images/004.PNG?raw=true "Add to cart")

After that, if we click on the same product, it will prompt a message saying **"Product already added"** and the product won't be added. We could use this exception handling to implement a custom message inside the product with Javascript in nexts features 

![Alt text](readme-images/005.PNG?raw=true "Product added")

If we click on the **"Go to cart"** button or in the number of cart product (top-right in the header) we will go to **/cart** and see all our products added

![Alt text](readme-images/006.PNG?raw=true "Cart")

Once we are in **/cart** we can see the list of our chosen products, and if we clicked in **"Apply 10% discount"** we will get a 10% discount (in a more efficient way I would created an Entity of discounts and I'll associated with existing users to only show that option for those users)

![Alt text](readme-images/007.PNG?raw=true "Apply discount")

![Alt text](readme-images/008.PNG?raw=true "Discount applied")

## Tests

I created Unit Tests in **/tests** folder that tests the use cases of the application and check the type of the variables we are receiving

We can run our tests by running the following command:

```bash
php bin/phpunit ./tests
```

![Alt text](readme-images/009.PNG?raw=true "Tests")
