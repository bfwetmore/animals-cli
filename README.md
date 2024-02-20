# AnimalProject

The AnimalProject is a CLI-based application that takes pairs of arguments (animal name and animal type) to output the corresponding animal sounds. It's a perfect tool for quick and fun interactions with various animal sounds.

## Requirements

- PHP 8.3+
- Composer

## Installation

Follow these steps to get the project up and running:
```
git clone https://github.com/bfwetmore/animals-cli
```

```
cd animals-cli
```

```
composer install
```

## Usage

This application is used via the terminal line. To run, navigate to the project root, and use the following command:
```
php AnimalProject.php [name1] [animal_type1] [name2] [animal_type2]
```

Use double quotes to encapsulate names or types with more than one word:
```
php AnimalProject.php "Mr Pickeles" cat Betsey cow
```

You can provide any number of name and animal type pairs. Each pair will result in a different animal sound output.

## Tests

To run the tests for this application, you can use the following command:

```
composer test
```

## Authors

Benjamin Wetmore - Initial Work

## License

This project is licensed under the terms of the MIT license.