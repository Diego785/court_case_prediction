# Court Case Prediction

Web system that tracks court cases and uses machine learning to estimate how likely a case is to succeed, to support lawyers' decisions.

## Context

Built in October 2023 as a decision-support system project.

## Features

- **Case management.** Register and edit cases with plaintiff, defendant, judge, requirements and start and end dates, with sortable lists.
- **Case history.** Each case keeps dated updates with its status, recorded as a success percentage.
- **Success prediction.** A least-squares linear regression (php-ml) is trained on each case's history and estimates its success percentage for the next day, kept between 0% and 100%.
- **Decision support.** The prediction is compared with the latest recorded value to say whether the trend favors the plaintiff or the defendant, with a recommendation.
- **Charts.** Case progress over time with Chart.js, by hour, day or month, within a date range.
- **PDF reports** of all cases and of a single case.

## Tech stack

Laravel 8 · Livewire 2 · php-ml · Chart.js · DomPDF · Jetstream · Tailwind CSS · MySQL

## How it works

Cases and their updates live in two tables. When a case is opened, its updates are sorted by date and used as training data: the date is the input and the success percentage is the target. The trained model predicts the next value, and Livewire refreshes the result, the recommendation and the chart without reloading the page.

## Run locally

```bash
composer install
npm install && npm run dev
cp .env.example .env        # set your MySQL credentials
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Author

Diego Hurtado Vargas · [GitHub](https://github.com/Diego785) · [LinkedIn](https://www.linkedin.com/in/diego-hurtado-vargas-perfil/)
