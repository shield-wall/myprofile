<p align="center">
  <img src="./doc/logo.webp">
</p>

# Examples

-   [Default](./data/examples/default.pdf)

# Generate your resume

Just create a new [Resume discussion](https://github.com/shield-wall/myprofile/discussions/new?category=resume) :smiley:.

# Run locally

I'm assuming that you have node 18 or higher installed in your machine.

```bash
npm install
npm run node:group:init
npm run dev
npm run node:group:pdf
```

### Preview

you can edit resume data in **data/data.yaml**

Note: you need to generate `json` and `pdf` again

```bash
npm run node:group:pdf
```
