declare const yourappSiteSetupValidator: {
  env: 'prod' | 'stg' | 'loc',
  errors: {
    general: string[],
    critical: string[],
  }
}