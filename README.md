# Pool Tournament  Challenge.
Homepage 
  - Block with ranking 
    - Ordered by points (first) and fewer balls left (second) 
  - Block with list of matches 
    - Search by friend name 
    - Link to match detail 
    - Link to friend detail 
Match detail page 
  - Match info 
Friend detail page 
  - Friend info 
  - Block with list of games 
Submission page 
  - Form to submit a match result between two friends 


# Required
- Composer
- PHP >= 7.2
- MySql

# Run

__Configs__
```python
./source/Config.php

Alter
ROOT -> Link Application

DB
host -> Host DB
port -> Port DB
username -> User DB
passwd -> Password DB
```

```python
./phinx.php

Alter
DB
host > Host DB
user -> User DB
pass -> Password DB
port -> Port DB
```

__Create Table MySql__
```python
pool_development
```

**Exec Migration**
```python
vendor/bin/phinx migrate -e development
```

**Exec Seeds**
```python
php vendor/bin/phinx seed:run -s FriendSeeder
```
```python
php vendor/bin/phinx seed:run -s MatchSeeder
```


# Packages
[coffeecode/router](https://packagist.org/packages/coffeecode/router)
[coffeecode/datalayer](https://packagist.org/packages/coffeecode/datalayer)
[robmorgan/phinx](https://packagist.org/packages/robmorgan/phinx)
[league/plates](https://packagist.org/packages/league/plates)
[fzaninotto/faker](https://packagist.org/packages/fzaninotto/faker)