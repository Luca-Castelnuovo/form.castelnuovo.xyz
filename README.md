<p align="center"><a href="https://github.com/Luca-Castelnuovo/Form"><img src="https://rawcdn.githack.com/CubeQuence/CubeQuence/855a8fe836989ca40c4e50a889362975eab9ac43/public/assets/images/banner.png"></a></p>

<p align="center">
<a href="https://packagist.org/packages/cubequence/cubequence"><img src="https://poser.pugx.org/cubequence/cubequence/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/cubequence/cubequence"><img src="https://poser.pugx.org/cubequence/cubequence/v/stable.svg" alt="Latest Stable Version"></a>
<a href="LICENSE.md"><img src="https://poser.pugx.org/cubequence/cubequence/license.svg" alt="License"></a>
</p>

# FormJS

Backend for email submissions powering serverless applications

- [Homepage](https://form.castelnuovo.xyz)
- [SDK](https://www.npmjs.com/package/mailjs-sdk)

## Installation

For development

1. `git clone git@github.com:Luca-Castelnuovo/form.git`
2. `composer install`
3. Edit `.env`
4. `php cubequence app:key`
5. `php cubequence db:migrate`
6. `php cubequence db:seed`
7. Start development server `php -S localhost:8080 -t public`

For deployment

1. `git clone git@github.com:Luca-Castelnuovo/form.git`
2. `composer install --optimize-autoloader --no-dev`
3. Edit `.env`
4. `php cubequence app:key`
5. `php cubequence db:migrate`

## Examples

**Form**
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="https://form.castelnuovo.xyz/form/d6dc8ede-690c-4446-80bd-d4942c8e1a67" method="post">

    <input type="hidden" name="subject" value="Pied Piper"/>
    <input type="hidden" name="redirect" value="https://example.com/thank_you"/>

    <!-- Replace these inputs with your own. Make sure they have a "name" attribute! -->
    <input type="text" name="name" value="Richard Hendricks"/>
    <input type="email" name="email" value="richard@piedpiper.com"/>

    <button type="submit">Submit</button>

</form>
</body>
</html>
```

**API**
```
curl --request POST \
  --url https://form.castelnuovo.xyz/api/1eb2ea99-f02b-69c6-93af-010063756265 \
  --header 'Content-Type: application/json' \
  --header 'Origin: localhost' \
  --data '{
	"subject": "fooBar Subject",
	"name": "Foo Bar",
	"email": "foor@bar.com"
}'
```

## Security Vulnerabilities

Please review [our security policy](https://github.com/Luca-Castelnuovo/form/security/policy) on how to report security vulnerabilities.

## License

Copyright © 2020 [Luca Castelnuovo](https://github.com/Luca-Castelnuovo). <br />
This project is [MIT](LICENSE.md) licensed.
