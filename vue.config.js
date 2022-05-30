const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true
})

module.exports = {
  configureWebpack: {
    devServer: {
      proxy: 'https://cat-fact.herokuapp.com/',
      headers: { "Access-Control-Allow-Origin": "*" }
    }
  }
};

module.exports = {
  publicPath: process.env.PUBLIC_URL || "/", // <-- this is correct now (and default)
  transpileDependencies: ["vuetify"],
};