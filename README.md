# RoundAbout Second Hand

A Small REST API created with PHP and MySQL as a part of an assignment for the "Systemutveckling PHP" Course.

## Content

- [Installation](#installation)
  Clone the REPO and use the SQL File to start a database, i used MAMP.
  Add the project to your htdocs folder.
- [Usage](#usage)
  The project can be viewed from a browser but to make a POST/PUT you need use something like postman with these links.

  ### GET

  http://localhost/roundabout/sellers/ - Display a list of all Sellers

  http://localhost/roundabout/sellers/{id} - Display a single seller, swap {id} for a number. This will also display all the items that belong to that seller.
  http://localhost/roundabout/items/ - Display a list of all items.

  http://localhost/roundabout/items/{id} - Display a single item, swap {id} for a number

  ### PUT

  http://localhost/roundabout/items/{id} - Mark an item as sold

  ### POST

  http://localhost/roundabout/sellers/ - Create a new seller using template:
  {
  "name":string,
  "total_items_submitted":number,
  "total_items_sold":number,
  "total_sales_amount":number
  }

  http://localhost/roundabout/items/ - Add a New Item using template:
  {
  "name":string,
  "seller_id": number,
  "submitted_date":string, ("2023-06-14")
  "sold": number,
  "price": number
  }
