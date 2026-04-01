# Eduteller Web Portal Technical Specifications

This document outlines the technical architecture, core requirements, and implementation strategies for the **Eduteller Narrative-Based Educational Portal**.

## Technical Stack
- **Backend Framework**: Laravel (PHP 8.4+)
- **Frontend Stack**: TALL Stack (Tailwind CSS, Alpine.js, Laravel, Livewire)
- **Database**: PostgreSQL (for structured data) & MongoDB (for learning analytics)
- **Caching**: Redis
- **Search Engine**: Meilisearch
- **Containerization**: Laravel Sail (Docker)

## Core Engine: Branching Narrative Logic
The portal’s "heart" is the branching narrative engine, designed to transform learning into an interactive story.
- **Narrative Passages**: Polymorphic relationships allow passages to be text scenarios, video chapters, or interactive quizzes.
- **Finite State Machine (FSM)**: Managed by `winzou/state-machine` to track learner progress through the "Hero’s Journey" story arc.
- **State Management**: Native PHP Enums define story states (e.g., `Draft`, `Published`) and narrative stages (`OrdinaryWorld`, `CallToAdventure`, etc.).

## Offline-First & Connectivity Strategy (Nigerian Context)
To address unreliable internet and high data costs in Nigeria:
- **PWA Implementation**: Progressive Web App using `ladumor/laravel-pwa`.
- **Local Persistence**: **IndexedDB** stores learning progress and content on the device.
- **Service Worker**: Implements "Cache-First" for static narrative assets and "Network-First" for quizzes.
- **Background Sync**: Uses the Background Sync API to push progress markers when connectivity is restored.
- **Data Compression**: `php-ffmpeg` for automatic video transcoding to 480p H.264 for mobile optimization.

## Standardized Learning Tracking (xAPI)
- **xAPI (Tin Can) Implementation**: Replaces SCORM to capture granular activity streams from branching narratives.
- **Learning Record Store (LRS)**: Integrated using `escolalms/lrs`.
- **Asynchronous Logging**: Laravel Jobs dispatch xAPI statements to the LRS to ensure a responsive UI.

## Financial & Business Logic
- **Payment Gateway**: Integration with **Flutterwave** and **Paystack** for Nigerian-specific payment methods (USSD, Bank Transfer, Verve).
- **Monetization**: Hybrid model supporting B2C family subscriptions and B2B school licensing.

## Accessibility & Compliance
- **WCAG 2.1 Level AA**: Strict compliance for Blade templates.
- **Alt-Text Requirements**: Mandatory descriptive tags for all story illustrations and media.
- **Keyboard Operability**: All interactive story choices must be fully operable without a mouse.

## Security & Scalability
- **ULIDs**: Used for all primary keys to facilitate distributed syncing and prevent data scraping.
- **API Rate Limiting**: Enforced to prevent bot attacks and ensure server stability.
- **CI/CD Pipeline**: GitHub Actions for automated PHPUnit/Pest testing and PHPStan static analysis.
