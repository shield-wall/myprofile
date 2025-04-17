import js from "@eslint/js";
import globals from "globals";
import css from "@eslint/css";
import { defineConfig, globalIgnores} from "eslint/config";


export default defineConfig([
  globalIgnores(["website/"]),
  { files: ["{src,node}/**/*.{js,mjs,cjs}"], plugins: { js }, extends: ["js/recommended"] },
  { files: ["{src,node}/**/*.{js,mjs,cjs}"], languageOptions: { globals: {...globals.browser, ...globals.node} } },
  { files: ["{src,node}/**/*.css"], plugins: { css }, language: "css/css", extends: ["css/recommended"] },
]);
