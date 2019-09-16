module.exports = {
  "overrides": [
    {
      // global variable mode for simple scripts (with no import)
      "files": ["resources/assets/js/**/*.js"],
      "parserOptions": {
        "sourceType": "script",
        "ecmaFeatures.globalReturn": false
      },
      "env": {
        "node": false
      }
    }
  ],
  "extends": "standard"
};
