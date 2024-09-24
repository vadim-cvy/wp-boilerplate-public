const path = require('path')
const glob = require('glob')

module.exports = () => ({
  mode: 'production',

  watch: true,

  entry: () => {
    const entryPoints = {}

    const srcDir = path.resolve(__dirname, 'assets/src/js')
    const entryPointFiles = glob.sync(`${srcDir}/**/index.ts`)

    entryPointFiles.forEach(fileRelPath => {
      const outputRelPath = path.dirname( fileRelPath.split( '\\js\\' )[1] )

      entryPoints[outputRelPath] = path.resolve( __dirname, fileRelPath )
    })

    return entryPoints
  },
  output: {
    path: path.resolve(__dirname, 'assets/dist/js'),
    filename: '[name]/index.js',
  },

  resolve: {
    extensions: ['.ts', '.js'],
  },

  module: {
    rules: [
      {
        test: /\.ts$/,
        use: 'ts-loader',
        exclude: /node_modules/,
      },
    ],
  },

  externals: {},
})