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
namespace Samils\Handler\Exception {
  use ApplicationStorage;
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
  if (!function_exists ('Samils\Handler\Exception\Base')) {
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
  function Base ($error) {
    $err = new SamilsError ();

    if (class_exists (ApplicationStorage::class)) {
      ApplicationStorage::Trigger ('Exception-Thrown');
    }

    $contentGetter = requires ('file-content-getter');

    $errorHandlerAguments ['lines'] = $contentGetter->getFileLines($error->getFile(),
      [ $error->getLine(), 6 ]
    );
    $errorHandlerAguments ['lines_high'] = [$error->getLine()];

    $err->message = $error->getMessage ();
    $errorHandlerAguments ['paragraphes'] = [
      'File => ' . $error->getFile (),
      'Line => ' . $error->getLine (),
      'Error Code => ' . $error->getCode ()
    ];

    $errorHandlerAguments ['title'] = 'Sami::Error';
    $errorHandlerAguments [ 'err' ] = $err;
    $errorHandlerAguments ['dumps'] = [];
    $errorHandlerAguments ['sources'] = [
      /**
       * Extracted source from the file where
       * the error is located in order showing a
       * part that file's content
       */
      'Extracted source from: '.$error->getFile ().'' => (
        $errorHandlerAguments ['lines']
      )
    ];

    return forward_static_call_array (
      [ErrorHandler::class, 'HanldeError'],
      [$errorHandlerAguments]
    );
  }}

  set_exception_handler (
    /**
     * @func Base
     * - Base class for the ils exception handler
     * - @version 2.0
     * - @since 1.0.8v
     */
    'Samils\\Handler\\Exception\\Base'
  );
}
