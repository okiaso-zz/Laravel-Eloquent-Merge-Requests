<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class NameController extends Controller {

  public function first_name( Request $request, string $name = null ) {
    $csv = implode( ',', array_merge( (array) $name, (array) $request->name ) );
    if( empty( $csv ) ) {
      return response()->json( [ 'message' => 'Please provide a name.' ] );
    }

    $names  = array_unique( explode( ',', $csv ) );
    $people = People::whereIn( 'first_name', $names )->get();

    //exit( var_export( $people->count() ) );
    return response()->json( $people );
  }

}
