[![GitHub release](https://img.shields.io/github/release/PhilippMundhenk/NoFrillsPhotoSharing.svg)](https://github.com/PhilippMundhenk/NoFrillsPhotoSharing/releases) [![GitHub issues](https://img.shields.io/github/issues/PhilippMundhenk/NoFrillsPhotoSharing.svg)](https://github.com/PhilippMundhenk/NoFrillsPhotoSharing/issues) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/PhilippMundhenk/NoFrillsPhotoSharing/blob/master/LICENSE)

**based on [HTML5-Photo-Upload](https://github.com/DynamsoftRD/HTML5-Photo-Upload) and [Fotorama](http://fotorama.io/) as gallery** 

# NoFrillsPhotoSharing
For a private event I required a quick and easy solution to collect the photos the guests took with their smartphones.
I tested a few apps, but not all are available for all platforms, some do require a registration (even for the guest) or involve (significant) cost.
As I needed none of all the extra functions these apps offered and already have a server available, I decided to quickly hack together a website where my guests can upload and download their photos.
To ensure that not the whole world has access, I added some simple password protection.

## Installation
Simply download the files in this repository and place it somewhere into a serveable directory in your PHP server.

## Configuration
Have a look at the config.php.
It is commented and should be pretty self-explanatory.

## Usage
- Open your web browser and browse to the folder where you placed your files.
If configured, enter password, try the buttons.
It's straight-forward.
- Call subdirectory /php/slideshow.php for a slideshow of full-resolution uploads.

## ToDo
- add download as zip
- change formatting of buttons and missing text for screen size variations
- ... so much more!