#!/bin/bash
set -e

APP_NAME="eduteller-portal-$(cat /dev/urandom | tr -dc 'a-z0-9' | fold -w 6 | head -n 1)"

echo "🚀 Bootstrapping Eduteller Showcase on Fly.io..."

# 1. Launch the app (non-interactive)
fly launch --name "$APP_NAME" \
           --region los \
           --org personal \
           --no-deploy \
           --copy-config

# 2. Provision Databases (Lagos-specific)
echo "🐘 Provisioning PostgreSQL..."
fly postgres create --name "$APP_NAME-db" --region los --initial-cluster-size 1 --vm-size shared-cpu-1x
fly postgres attach "$APP_NAME-db" --app "$APP_NAME"

echo "🔴 Provisioning Redis Cache..."
fly redis create --name "$APP_NAME-redis" --region los --plan Free

# 3. Securely Set Environment Secrets
echo "🔑 Setting Eduteller-specific secrets..."
fly secrets set APP_KEY=$(php artisan key:generate --show --no-ansi) \
                FLUTTERWAVE_PUBLIC_KEY="placeholder_pk" \
                FLUTTERWAVE_SECRET_KEY="placeholder_sk" \
                FLUTTERWAVE_SECRET_HASH="eduteller_secure_hash"

# 4. Final Deploy
echo "🚢 First-time Deployment..."
fly deploy --ha=false

echo "✅ Deployment Complete! Showcase URL: https://$APP_NAME.fly.dev"
