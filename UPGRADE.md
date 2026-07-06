# Upgrade Guide

This document lists steps to upgrade between major and minor releases of `binkode/laravel-paystack`.

---

## Upgrading to v1.2.0 (Namespace Migration)

### 1. Update Namespace Imports
The package namespace was changed from `Myckhel\Paystack` to `Binkode\Paystack`. You must search and replace all instances of the old namespace in your project codebase:

- **Before:**
  ```php
  use Myckhel\Paystack\Facades\Paystack;
  use Myckhel\Paystack\Traits\Request;
  ```

- **After:**
  ```php
  use Binkode\Paystack\Facades\Paystack;
  use Binkode\Paystack\Traits\Request;
  ```

### 2. Update Service Provider Registration (If Not Using Package Auto-Discovery)
If you disabled Laravel's package auto-discovery and registered the provider manually in your `config/app.php` (or `bootstrap/providers.php` in modern Laravel), update the service provider reference:

- **Before:**
  ```php
  Myckhel\Paystack\PaystackServiceProvider::class,
  ```

- **After:**
  ```php
  Binkode\Paystack\PaystackServiceProvider::class,
  ```

---

## Upgrading to v1.5.0 & Higher (PHP & Laravel Version Upgrades)

### 1. Minimum PHP Version
Ensure your local development environment and server run **PHP 8.1 or higher**. The package is no longer tested on PHP versions below 8.1.

### 2. Laravel Compatibility
If upgrading to Laravel 12 or 13:
- Ensure that the package version constraints in `composer.json` allow the installation of these versions.
- If you override or bind package classes/interfaces in your application container, check method signatures for return type-hinting changes.
