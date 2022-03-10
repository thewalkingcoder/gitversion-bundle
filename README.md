# TwcGitVersion

Extract last git tag to manage app versioning.

## Installation

```bash
composer require twc/gitversion-bundle
```

## Basic Usage

### Configuration

| key             | definition                                    | default       |
|-----------------|-----------------------------------------------|---------------|
| default_version | value when tag not exist                      | v0.1.0        |
| file_name       | file Name including last git tag | VERSION |

```yaml
#If you want to change default value create config/packages/twc_gitversion.yaml

twc_gitversion:
  default_version: 'v0.0.0'

```

### Generate version

```bash
bin/console twc:generate:version
```

### Get last version

with twig

```twig

{{ twc_version }}

```

with php

```php

use Twc\GitversionBundle\Provider\GitVersionProvider;

public function home(GitVersionProvider $gitVersionProvider)
{ 
    $version = $gitVersionProvider->get();
    dump($version->toString());
}
```




