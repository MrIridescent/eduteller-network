# Repository Guidelines

This repository serves as the **Strategic and Technical Specification** hub for the **Eduteller Narrative-Based Educational Portal**. Eduteller is a Nigerian educational advocacy and consultancy platform focused on **intentional school choices** and **narrative-driven learning**.

## Project Context & Mission
The project aims to transform the educational experience into a narrative journey, positioning the learner as the protagonist within a personalized, interactive ecosystem.
- **Goal**: Bridge the gap between school branding and actual quality of care/education.
- **Key Framework**: **F.I.T.S Model™** (Find the Child, Investigate the School, Test Alignment, Support Transition).
- **Philosophical Focus**: Intentionality, transparency, and "Child–School Fit" consultancy.

## Project Structure & Module Organization
The architecture is designed to be **layered**, extending standard MVC with **Actions** for narrative-specific logic (e.g., branching choice processing).
- **Narrative Engine**: Powered by a **Finite State Machine (FSM)** using `winzou/state-machine` to manage "Hero's Journey" arcs.
- **Schema**: **Polymorphic Relationships** for educational artifacts (Stories, Passages, Quizzes) and **ULIDs** for offline-first sync.
- **Offline-First PWA**: Implemented via `ladumor/laravel-pwa` and **Service Workers**, leveraging **IndexedDB** for data persistence.
- **Tracking & Analytics**: Standardized on **xAPI (Experience API)** via `escolalms/lrs` to capture granular interaction data.

## Build, Test, and Development Commands
The project is managed via **Laravel Sail** (Docker). Key commands include:
- **Initialization**: `curl -s "https://laravel.build/eduteller?with=mysql,redis,meilisearch" | bash`
- **Environment Management**: `./vendor/bin/sail up -d`
- **Static Analysis**: `./vendor/bin/sail bin phpstan analyze`
- **Testing**: `./vendor/bin/sail artisan test` or `./vendor/bin/sail bin pest`

## Coding Style & Naming Conventions
- **Strict Typing**: Leverage native PHP 8.4+ features including Enums for state and narrative stages.
- **Layered MVC**: Business logic resides in **Action** classes, not Controllers or Models.
- **Accessibility**: All Blade templates must comply with **WCAG 2.1** standards.
- **Identifier Strategy**: Use ULIDs for all primary keys to facilitate offline-first sync.

## Testing Guidelines
- **Framework**: PHPUnit or Pest PHP.
- **Feature Tests**: Must simulate full narrative paths to ensure no "dead ends" in story branches.
- **Static Analysis**: Mandatory `phpstan` checks in the CI/CD pipeline.

## Commit & Pull Request Guidelines
Contributors must ensure that all feature implementations align with the architectural and philosophical specs defined in `SPECS.md` and `eduteller.md`.
