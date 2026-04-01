# 🇳🇬 Eduteller: Narrative-Based Educational Portal

Eduteller is a high-impact educational advocacy and consultancy platform designed for the Nigerian market. It bridges the gap between school branding and actual quality of education through intentionality, transparency, and a narrative-driven learning ecosystem.

---

## 🎯 Core Framework: The F.I.T.S Model™
The portal is built around the proprietary **F.I.T.S Model**, ensuring a perfect "Child-School Fit":
1.  **Find the Child**: Personality and learning trait assessment.
2.  **Investigate the School**: Deep-dive investigations into culture, safety, and nurture.
3.  **Test Alignment**: Automated "Fit Scoring" between child needs and school standards.
4.  **Support Transition**: Ongoing advocacy and narrative-based onboarding.

---

## 🚀 Technical Architecture
-   **Backend**: Laravel 11 (PHP 8.3+)
-   **Frontend**: TALL Stack (Tailwind CSS, Alpine.js, Laravel, Livewire)
-   **Narrative Engine**: Finite State Machine (FSM) via `winzou/state-machine` for "Hero's Journey" branching logic.
-   **Offline-First**: PWA implementation with IndexedDB for sync in low-connectivity Nigerian regions.
-   **Monetization**: Integrated **Flutterwave** for USSD, Bank Transfer, and Verve card payments.
-   **Identifiers**: **ULIDs** for all primary keys to ensure offline-first sync integrity.

---

## 🚢 Zero-Click Deployment (Fly.io)
This repository is pre-configured for automated deployment to the **Lagos (LGS)** server region for minimal latency.

### 1. Setup GitHub Secrets
Add these to your repository settings:
-   `FLY_API_TOKEN`: Your Fly.io deployment token (`fly tokens create deploy`).
-   `FLUTTERWAVE_SECRET_KEY`: Your payment gateway integration key.

### 2. Deployment Workflow
Every push to the `main` branch triggers:
-   **Docker Build**: Optimized production image creation.
-   **Auto-Provisioning**: PostgreSQL and Redis setup.
-   **Live Deployment**: App served at `https://eduteller-portal.fly.dev`.

---

## 🛠️ Local Development
1.  **Clone & Install**:
    ```bash
    composer install
    npm install && npm run dev
    ```
2.  **Environment**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
3.  **Database**:
    ```bash
    touch database/database.sqlite
    php artisan migrate --seed
    ```
4.  **Serve**:
    ```bash
    php artisan serve
    ```

---

## 📜 Repository Structure
-   `app/Actions`: Core business logic (Fit Scoring, Narrative Processing).
-   `app/Services`: Third-party integrations (Flutterwave, xAPI, FSM).
-   `resources/views/livewire`: Interactive dashboards for Parents and Educators.
-   `bootstrap.sh`: One-click provisioning script for Fly.io.

---

## 🤝 Contributing
Align all feature implementations with the technical specs in `SPECS.md` and the philosophical mission in `eduteller.md`.
