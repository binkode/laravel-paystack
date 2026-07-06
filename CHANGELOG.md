# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Integrated Support, Controllers, and Tests for the following Paystack APIs:
  - **Terminal API** (`Binkode\Paystack\Support\Terminal`)
  - **Virtual Terminal API** (`Binkode\Paystack\Support\VirtualTerminal`)
  - **Order API** (`Binkode\Paystack\Support\Order`)
- Added support for Laravel 13 and PHP 8.4 in dependency constraints and GitHub Actions testing configurations.
- Added `guzzlehttp/guzzle` explicitly as a package dependency.

## [1.5.0] - 2026-02-18

### Fixed
- Fixed type hint for `config` parameter in `PaystackConfig` class.

## [1.4.0] - 2025-04-08

### Added
- Added support for Laravel 12.

## [1.3.0] - 2024-04-12

### Added
- Added support for Laravel 11.

## [1.2.0] - 2024-02-13

### Changed
- Migrated codebase namespace from `Myckhel\Paystack` to `Binkode\Paystack`.

## [1.1.1] - 2023-04-30

### Fixed
- Fixed old path to `PaystackConfig` following the namespace transition.

## [1.1.0] - 2023-04-23

### Changed
- Updated description and links for the webhooks demo.

## [1.0.1] - 2022-11-20

### Fixed
- Fixed PHP warning when initializing configuration values.

## [1.0.0] - 2022-07-24

### Added
- Created `ValidatePaystackHook` middleware to validate incoming Paystack webhooks.
- Extracted hooks routes from the main route group to prevent middleware inheritance issues.
- Added `DisableRoute` middleware to selectively disable routes.

## [1.0.0-beta.0] - 2022-05-27

### Added
- Added webhook log event documentation to `README.md`.

## [1.0.0-alpha.6] - 2022-05-26

### Changed
- Enhanced routing list formatting and documentation in `README.md`.

## [1.0.0-alpha.5] - 2022-05-25

### Added
- Implemented `ControlPanel` APIs.

## [1.0.0-alpha.4] - 2022-05-21

### Added
- Implemented `Recipient` APIs.

## [1.0.0-alpha.3] - 2022-05-20

### Added
- Implemented `Subscription` APIs.

## [1.0.0-alpha.2] - 2022-05-20

### Added
- Implemented `DedicatedVirtualAccount` APIs.

## [1.0.0-alpha.1] - 2022-05-15

### Fixed
- Corrected typos and formatting in `README.md`.

## [1.0.0-alpha.0] - 2022-05-14

### Added
- Initial release containing wrapper support for:
  - `Charge`, `Dispute`, `Refund`, `Verification`, `Miscellaneous`, `Transfer`, `TransferControl`, `BulkCharge`, `Settlement`, `Invoice`, `Page`, `Product`, `Plan` APIs.
