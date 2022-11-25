## Event App

Event App is a simple crud application, for managing the events.

## Installing Event App
#### Clone the project either with ssh or https

```
git clone git@github.com:Muniraj577/event-app.git
```
#### Or
```
git clone https://github.com/Muniraj577/event-app.git
```

#### Run Composer install to install all the packaeges
```
composer install
```

#### Copy .env.example to .env

```
cp .env.example .env
```

#### Generate a encryption key
```
php artisan key:generate
```

#### Migrate database and seed the data
```
php artisan migrate

php artisan db:seed
```

#### Install Packages for frontend and build assets
```
npm install

npm run dev
```

#### Run the project
```
php artisan serve
```

