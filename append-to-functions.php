
/**
* Format can be 'time' or 'date'. Defaults to date.
* Usage: [calendly format='{format}']
* e.g. [calendly format='time'] returns time
* e.g. [calendly] just returns date
*
*  Relies on this function: https://github.com/adrelliott/dynamic-keyword-insertion
*/
add_shortcode('calendly', 'obl_datetime');

/**
* Function for translating date and time from a timestamp
* 
*/
function obl_datetime ( $attributes ) {
  
  // Test for var in the URL and bail if nothing is returned (i.e. no param found)
  $timestamp = dynamic_content( ['key' => 'event_start_time'] );
  if (  empty( $timestamp ) )
    return "";
  
  // Now convert into an array of day, month etc
  $timestamp = strtotime( $timestamp );
  
  // Not an timestamp? Return nothing.
  if ( !is_int( $timestamp ) OR empty( $timestamp ) )
    return "";
  
  // Else output the time/date accordingly
  if ( $attributes['format'] == 'time' ) {
    return date( 'g\:ia', $timestamp );
  } 
  else {
    return date( 'l jS \of F Y', $timestamp );
  }
}
