# AGENTS.md

## Purpose
This repository is a Laravel package (`binkode/laravel-paystack`) that wraps Paystack APIs for Laravel apps. Use these rules to keep contributions safe, compatible, and consistent.

## Project Facts (Source of Truth)
- Package type: Composer library (`type: package`)
- Namespace: `Binkode\\Paystack\\`
- Runtime dependency target: `illuminate/support ^8|^9|^10|^11`
- Test framework: PHPUnit via `composer test`
- Package test harness: `orchestra/testbench`

## Non-Negotiable Rules
- Preserve backward compatibility for public APIs in `src/Support/*`, routes, config keys, and facade/provider wiring.
- Prefer minimal, focused changes over broad refactors.
- Do not introduce breaking signature or route changes unless explicitly requested.
- Add or update tests for behavior changes.
- Update `readme.md` when public usage changes.

## Code Style and Compatibility
- Follow existing style in this codebase for spacing, naming, and method layout.
- Keep syntax compatible with Laravel 8-11 ecosystem constraints.
- Avoid introducing framework-version-specific helpers unless guarded.
- Reuse existing abstractions before adding new layers.

## Package Architecture Rules
- HTTP calls belong in support classes using `Binkode\\Paystack\\Traits\\Request`.
- Route exposure is centralized in `src/routes.php`.
- Controllers are thin adapters that delegate to support classes.
- Service container bindings and route/config registration stay in `src/PaystackServiceProvider.php`.
- Configuration keys and defaults stay in `config/paystack.php`.

## Endpoint Addition Checklist
When adding or changing a Paystack endpoint:
1. Implement or update method in the relevant class under `src/Support/`.
2. If route exposure is required, register/update route entry in `src/routes.php`.
3. Ensure controller dispatch maps correctly to support method.
4. Add tests for success and failure behavior.
5. Update usage docs in `readme.md` if public surface changed.

## Testing Rules
- Run `composer test` after code changes.
- For HTTP behavior, use Laravel HTTP fakes; do not rely on live Paystack calls.
- Validate both happy path and failed response handling.
- If tests cannot run locally, report exactly why.

## Safe Change Boundaries
- Keep edits scoped to files needed for the task.
- Do not rename classes, namespaces, config keys, or route paths without explicit approval.
- Avoid dependency additions unless required and justified.

## High-Signal Prompting Template (Use for Codex Requests)
Use this template for best results:

```md
Task: <one clear outcome>
Context: <feature/bug + why it matters>
Scope: <files allowed to change>
Constraints: <BC rules, style, versions, no new deps, etc.>
Acceptance Criteria:
- <observable behavior 1>
- <observable behavior 2>
Tests:
- <exact command, usually `composer test`>
Deliverable:
- <expected summary format, e.g., changed files + rationale>
```

## Example Prompt
```md
Task: Add support for Paystack endpoint X in this package.
Context: Needed by merchants to perform Y from Laravel jobs.
Scope: `src/Support/X.php`, `src/routes.php`, `src/Http/Controllers/XController.php`, `tests/*`, `readme.md`.
Constraints: Keep backward compatibility, no new dependencies, match existing code style.
Acceptance Criteria:
- New support method calls the correct endpoint with expected HTTP method.
- Route dispatch reaches the support method.
- Failure responses are handled consistently with existing request trait behavior.
Tests:
- `composer test`
Deliverable:
- Patch + short summary + any follow-up risks.
```

## Definition of Done
- Code compiles and aligns with existing package patterns.
- Tests added/updated and executed (or blocker clearly stated).
- Docs updated when behavior or API usage changed.
- No unintended API or routing regressions.
