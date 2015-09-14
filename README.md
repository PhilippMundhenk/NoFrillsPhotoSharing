# NoFrillsPhotoSharing
For a private event I required a quick and easy solution to collect the photos the guests took with their smartphones.
I tested a few apps, but not all are available for all platforms, some do require a registration (even for the guest) or involve (significant) cost.
As I needed none of all the extra functions these apps offered and already have a server available, I decided to quickly hack together a website where my guests can upload and download their photos.
To ensure that not the whole world has access, I added some simple password protection.

## work in progress!
This project is still heavily under development.
The minimal set of functions is functional, however.

## Installation
Simply download the files in this repository and place it somewhere into a serveable directory (<directory>) in your PHP server.

## Configuration
Have a look at the config.php.
It is commented and should be pretty self-explanatory.

## Usage
- Open your web browser and browse to the folder where you placed your files.
If configured, enter password, try the buttons.
It's straight-forward.
- Call <directory>/php/slideshow.php for a slideshow of full-resolution uploads.

## References
- partially based on: https://github.com/DynamsoftRD/HTML5-Photo-Upload
- uses http://fotorama.io/ as gallery

## ToDo
- add download as zip
- change formatting of buttons and missing text for screen size variations
- ... so much more!