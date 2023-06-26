# Monolog Cloudwatch Handler

Simple monolog handler for aws cloudwatch

## Getting Started

```shell
$ composer require jolicht/monolog-cloudwatch-handler
```

Configure monolog in `config/packages/monolog.yaml`:

```yaml
monolog:
  handlers:
    main:
      type: fingers_crossed
      action_level: error
      handler: cloudwatch
    cloudwatch:
      type: service
      id: cloudwatch_handler
```
Configure Cloudwatch Handler in `config/services.yaml`:

```yaml
services:
  cloudwatch_handler:
    class: Jolicht\MonologCloudwatchHandler\CloudWatchHandler
    arguments:
      $logGroupName: your_preferred_loggroup_name
      $logStreamName: "%kernel.environment%"
```