# Contributing Guidelines

Thank you for considering contributing to the `binkode/laravel-paystack` package! We welcome contributions that improve features, fix bugs, or optimize the library. To maintain code quality and consistency, please follow these guidelines.

---

## Code of Conduct

By participating in this project, you agree to abide by our [Code of Conduct](CODE_OF_CONDUCT.md). Please report any unacceptable behavior to the project maintainers.

## How Can I Contribute?

### Reporting Bugs
If you find a bug, please search existing issues to see if it has already been reported. If not, open a new issue containing:
- A clear description of the bug.
- Steps to reproduce the issue.
- Expected vs. actual behavior.
- Relevant environment details (PHP version, Laravel version, package version).

### Suggesting Enhancements
If you have ideas for new features or improvements to existing APIs, open an issue explaining the proposed change, its use case, and potential implementation.

---

## Local Development Setup

To set up the package locally for development:

1. **Fork the Repository:** Fork and clone the repository to your local machine.
2. **Install Dependencies:** Run composer to install the development dependencies:
   ```bash
   composer install
   ```

### Coding Conventions
- **Code Style:** All PHP files must conform to the **PSR-12** coding style guide.
- **Strict Typing:** Always consider adding `declare(strict_types=1);` to new files.
- **Type Hints:** Use type declarations for function arguments and return types where applicable.

---

## Testing Guidelines

We require tests for all bug fixes and new features.

- **Mocking HTTP Calls:** Do NOT make live HTTP requests to the Paystack API within tests. Use Laravel's HTTP Fake features or the package's existing testing abstractions to mock requests and responses.
- **Test Framework:** We use **PHPUnit** for our test suite.
- **Running Tests:** You can execute the test suite by running:
   ```bash
   composer test
   ```
- Ensure all tests pass before submitting a pull request.

---

## Pull Request Process

1. **Create a Branch:** Create a focused branch for your changes (e.g., `feature/terminal-api` or `bugfix/config-hint`). Avoid submitting pull requests directly from your `main` branch.
2. **Write Meaningful Commit Messages:** Keep commit messages concise, descriptive, and formatted in the imperative mood (e.g., "Add terminal endpoint support" instead of "Added terminal support").
3. **Keep PRs Focused:** Submit one pull request per feature or bug fix. If you want to do multiple unrelated things, submit them as separate PRs.
4. **Squash History:** Before submitting, please squash intermediate or draft commits into clean, logical commits.
5. **Update Documentation:** If your changes introduce new methods, configurations, or alter existing behavior, ensure the `README.md` is updated to reflect this.

---

## Pull Request Checklist

Before submitting your PR, double-check that you have:
- [ ] Conformed to the PSR-12 coding standard.
- [ ] Added or updated tests to cover your changes.
- [ ] Verified that the test suite runs and passes successfully (`composer test`).
- [ ] Updated the `README.md` (if applicable).
- [ ] Updated `CHANGELOG.md` with your changes under the `[Unreleased]` section.
