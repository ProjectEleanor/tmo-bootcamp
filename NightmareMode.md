# Nightmare Mode

Deploy your registry server, write and upload either a Github Gist or a Gitlab repo README, providing details for how one would push an image to your service! Paste a link to that Gist or README below.

## Deploy Custom Registry
* docker run -d -p 5000:5000 --name registry registry:2 

## Pushing MoviesAPI into custom Registry
  Note: MoviesAPI had been previously pushed to DockerHub jazco99/moviesapi
* docker tag jazco99/moviesapi localhost:5000/moviesapi
* docker push localhost:5000/moviesapi

## Test using custom Registry
  Note: First removed all containers/images of moviesapi
*  docker run -d --rm -p 80:8080 localhost:5000/moviesapi
