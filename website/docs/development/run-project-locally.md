---
sidebar_position: 1
---

# How to run the project locally
```bash
docker compose run --rm app npm i
docker compose up -d
```

### Preview

Open https://localhost:8000 to visualise your CV.

you can edit resume data in **data/data.yaml**

Note: you need to generate a `pdf` again

```bash
docker compose run --rm pdf
```
