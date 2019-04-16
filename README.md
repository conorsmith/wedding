# Wedding Application

## Manually Creating a User

```php
$user = new ConorSmith\Wedding\User;
$user->name = "Admin";
$user->email = "email@example.com";
$user->password = Hash::make("password");
$user->save();
```
