<?php
  define("TIMEBEFORE_NOW",         'Agora mesmo' );
  define("TIMEBEFORE_MINUTE",      'Há cerca de {num} minuto atrás' );
  define("TIMEBEFORE_MINUTES",     'Há cerca de {num} minutos atrás' );
  define("TIMEBEFORE_HOUR",        'Há cerca de {num} hora atrás' );
  define("TIMEBEFORE_HOURS",       'Há cerca de {num} horas atrás' );
  define("TIMEBEFORE_DAYS",        'Há cerca de {num} dias atrás' );
  define("TIMEBEFORE_WEEK",        'Há cerca de {num} semana atrás' );
  define("TIMEBEFORE_WEEKS",       'Há cerca de {num} semanas atrás' );
  define("TIMEBEFORE_MONTH",       'Há cerca de {num} mês atrás' );
  define("TIMEBEFORE_MONTHS",      'Há cerca de {num} meses atrás' );
  define("TIMEBEFORE_YESTERDAY",   'Ontem ás {num}' );
  define("TIMEBEFORE_FORMAT",      '%A, %d de %B às %H:%M' );
  define("TIMEBEFORE_FORMAT_YEAR", '%A, %d de %B de %Y às %H:%M' );

  function time_ago( $time ) {
    $out    = '';
    $now    = time();
    $diff   = $now - $time;

    if( $diff < 60 )
      return TIMEBEFORE_NOW;

    elseif( $diff < 3600 )
      return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES );

    elseif( $diff < 3600 * 24 )
      return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS );

    elseif( $diff < 3600 * 24 * 2 )
      return str_replace( '{num}', date("H:i", $time), TIMEBEFORE_YESTERDAY );

    elseif( $diff < 3600 * 24 * 7 )
      return str_replace( '{num}', round( $diff / ( 3600 * 24 ) ), TIMEBEFORE_DAYS );

    elseif( $diff < 3600 * 24 * 7 * 4 )
      return str_replace( '{num}', ( $out = round( $diff / ( 3600 * 24 * 7 ) ) ), $out == 1 ? TIMEBEFORE_WEEK : TIMEBEFORE_WEEKS );

    elseif( $diff < 3600 * 24 * 7 * 4 * 12 )
      return str_replace( '{num}', ( $out = round( $diff / ( 3600 * 24 * 7 * 4 ) ) ), $out == 1 ? TIMEBEFORE_MONTH : TIMEBEFORE_MONTHS );

    else
      return ucfirst(strftime( date( 'Y', $time ) == date( 'Y' ) ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time ));

  }

?>
