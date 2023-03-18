Myprofile templates
===================
> **Warning**
> 
> This prohect is still in progress and will be moved to [myprofile](https://github.com/shield-wall/myprofile)

# Examples
 - [Default](./data/examples/default.pdf)

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