import Swal from "sweetalert2"

(() =>
{
  const generateErrorsList = ( errors: string[] ) =>
  {
    return `
      <ol style="margin-left: 1.2em; line-height: 1.6;">
        <li style="margin-bottom: 1em;">${errors.join( '</li><li>' )}</li>
      </ol>`
  }

  const
    criticalErrors = yourappSiteSetupValidator.errors.critical,
    generalErrors = yourappSiteSetupValidator.errors.general

  let
    title = 'Setup errors detected!',
    html = '<div style="text-align: left;">'

  if ( yourappSiteSetupValidator.env === 'prod' )
  {
    if ( criticalErrors.length )
    {
      title = 'Urgent!'

      html += '<b>Non-admin users denied access</b> due to the critical errors.'
    }
    else
    {
      html = 'Errors are not critical and <b>users can access the site</b> still.'
    }

    html += '<br>'
  }

  if ( criticalErrors.length )
  {
    html +=
      'Critical Errors:<br>' +
      generateErrorsList( criticalErrors ) +
      '<br>General Errors:<br>'
  }

  html += generateErrorsList( generalErrors )

  html += '</div>'

  const envLabel = {
    'prod': 'Produciton',
    'stg': 'Staging',
    'loc': 'Local',
  }[ yourappSiteSetupValidator.env ].toUpperCase()

  Swal.fire({
    icon: 'error',
    title,
    html,
    footer:
      `<p>
        Environment: <b>${envLabel}</b>
      </p>`,
  })
})()
