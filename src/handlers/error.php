<?php
/**
 * Samils\Functions
 * @version 1.0
 * @author Sammy
 *
 * @keywords Samils, ils, ils-global-functions
 * ------------------------------------
 * - Autoload, application dependencies
 */
namespace Samils\Handler\Error {
  use Sammy\Packs\FileContentGetter;
  use Sammy\Packs\ApplicationStorage;
  use Samils\Handler\Error as SamilsError;
  use Sammy\Packs\Samils\ApplicationServer\ErrorHandler;
  /**
   * Make sure the command base internal function is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   * ----
   * @Function Name: Samils\Handler\Error\Base
   * @Function Description: Base Error handler
   * @Function Args: $err_code, $message, $file, $line, ...$args
   */
  if (!function_exists ('Samils\Handler\Error\Base')) {
  /**
   * @version 1.0
   *
   * THE CURRENT YAMT COMMAND IS PROVIDED
   * TO AID THE DEVELOPMENT PROCESS IN ORDER
   * IT GET IN THE SAME WAY WHEN MOVING IT FROM
   * ANOTHER TO ANOTHER ENVIRONMENT.
   *
   * Note: on condition that this is an automatically
   * generated file, it should not be directly changed
   * without saving whole the changes into the original
   * repository source.
   *
   * @author Ag
   * @keywords Function Keywords
   */
  function Base ($err_code, $message, $file, $line) {
    $err = new SamilsError ();

    if (class_exists (ApplicationStorage::class)) {
      ApplicationStorage::Trigger ('Error');
    }

    $errorHandlerAguments = [];
    $contentGetter = new FileContentGetter;

    if ( $contentGetter ) {
      $errorHandlerAguments [ 'lines' ] = $contentGetter->getFileLines (
        $file, [ $line, 6 ]
      );
      $errorHandlerAguments [ 'lines_high' ] = [$line];
      $errorHandlerAguments [ 'sources' ] = [
        /**
         * Extracted source from the file where
         * the error is located in order showing a
         * part that file's content
         */
        'Extracted source from: '.$file.'' => (
          $errorHandlerAguments [ 'lines' ]
        )
      ];
    }

    $err->message = $message;
    $err->status = 500;
    $errorHandlerAguments [ 'title' ] = 'Sami::Error';

    $errorHandlerAguments [ 'err' ] = $err;
    $errorHandlerAguments [ 'paragraphes' ] = [
      'File => ' . $file,
      'Line => ' . $line,
      'Error Code => ' . $err_code
    ];


    return forward_static_call_array (
      [ErrorHandler::class, 'HanldeError'],
      [$errorHandlerAguments]
    );
  }}

  set_error_handler ('Samils\\Handler\\Error\\Base',
    E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
  );
}
