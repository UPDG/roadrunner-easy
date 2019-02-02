# Easy RoadRunner

Integration layer for [RoadRunner](https://github.com/spiral/roadrunner) that allows to create easy integrations/bridges for RoadRunner.

At this moment supports PSR7 and raw RoadRunner requests.

## List of integrations using Easy

| Framework/Library | Link                                       | Status |
|-------------------|--------------------------------------------|--------|
| Laravel           | https://github.com/UPDG/roadrunner-laravel | Stable |
| Symfony           | https://github.com/UPDG/roadrunner-symfony | Beta   |

## Using different RoadRunner Relay

If you not using default relay (`new \Spiral\Goridge\StreamRelay(STDIN, STDOUT)`) you can pass relay object as second
parameter of `\updg\roadrunner\easy\RoadRunner()`.

## How to create integrations

In order to create integration you have to implement `PSR7IntegrationInterface` or `HttpIntegrationInterface`.

After it you can use it as follows:

```php
$integration = new MyAwesomeIntegration();
$bridge = new \updg\roadrunner\easy\RoadRunner($integration);
$bridge->run();
```
