### 1) Given the following two arrays, write code that will create another array with values that are present in only one of the arrays.

```
$a1 = [1, 5, 7, 8]; 
$a2 = [4, 5, 8, 9];
```

Answer:
```array_merge(array_diff($a1, $a2), array_diff($a2, $a1));```

### 2)​ ​You have been asked to implement a REST based service for a client so that external parties can access their database. List the steps you would go through to build a REST service for your client and list key features, functions and design considerations that you would expect in a production grade REST service.

I'm defining some of the steps required bellow. More or less item will be required depending on the clients needs.

* Define which entity needs to be accessed (e.g. product, person, etc). For the sake of this example I'm going to consider it a generic product.

* Define the entity schema. What attributes of the product need to be exposed? e.g. id, size, colour, brand, etc.

* Define what HTTP verbs to use in this REST API. What actions the consumer of this service will be allowed to perform? e.g list  (GET /products), see  details (GET /products/{id}), create a new record (POST /products) or update a record (PUT /products/{id})

* Define what endpoints (actions) will require authentication. In the example above POST and PUT request should be authenticated.

* Make sure the authentication is implemented in a way that keeps the API stateful for better scalability.

### 3) Fix the bug in the following code

```<?php

class Problem {

	public static function average($a, $b) 
	{
		return $a + $b / 2; 
	}
}
```

Answer:
```return ($a + $b) / 2;```

### 4) When and why would you use a closure in PHP?

When using native PHP functions that expect a function as a parameter. 

### 5) In your opinion, list 3 of the biggest changes PHP has gone through in the last 4 years.

* Performance improvements from version 5.6 to 7.0;
* Return type declarations;
* Null coalescing operator.

### 6) When building an online form to collect sensitive data which is to be stored in a database, list the considerations that you must be aware of to ensure data integrity and security.

* Validate and filter the input;
* Scape the output.
* Use a database adapter that suports prepared statements.

### 7) Given the following MySQL 5.6 schema and data

```
CREATE TABLE `location` (
`id` int(11) NOT NULL,
`town` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8
INSERT INTO crawler.location (id, town) VALUES(1, 'Sydney'); INSERT INTO crawler.location (id, town) VALUES(2, 'Brisbane');
```

List any reasons you can think of as to why the following query would return no results 

```SELECT id FROM location WHERE town = ‘Sydney’```

Answer:

There is no PHP code here, so I'm assuming this being run in the command line. 

There are a few things that might be causing the problem:

1) Mission ; in the create statement;

2) The quotes around the word 'Sydney' seem to be invalid. It's not clear to me if that's is just a PDF formatting issue.

3) No database is being selected in the query. The person running this should select the database first by typing 'use crawler;' or run the query as ```SELECT id FROM crawler.location WHERE town = 'Sydney'```

### 8) The file user.php contains a class for handling user registrations. It has been intentionally coded to contain errors, demonstrate poor development practices and be inefficient.

You have been asked to review the code and “improve” it by correcting errors, removing inefficiencies and demonstrate good programming practices.

* For each change you make you should explain why you did it.
* Where information is not available, you should make assumptions.
* For larger good practice changes, it is fine to just describe these changes without actually making the change.

Answer:
I'm going to do this in a Pull Request format and adding my comments. Please check here: https://github.com/rosantoz/rm-apr-2018/pull/1
