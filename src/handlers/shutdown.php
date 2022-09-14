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
namespace Samils\Handler\ShutDown {
  use ApplicationStorage;
  use Samils\Handler\Error as SamilsError;
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
  if (!function_exists ('Samils\Handler\ShutDown\Base')) {
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
  function Base () {
    $error = error_get_last ();

    if (class_exists (ApplicationStorage::class)) {
      ApplicationStorage::Trigger ('ShutDown');
    }

    if (is_array ($error) && $error) {
      $err = new SamilsError ();

      $file = $error['file'];
      $line = $error['line'];

      $contentGetter = requires ( 'file-content-getter' );
      $lines = $contentGetter->getFileLines($file, [$line, 6]);

      $err->message = $error ['message'];
      $err->title = 'Sami::Error';

      $err->handle ([
        'title' => 'Sami::Error',
        'lines_high' => [$line],

        'paragraphes' => [
          'File => ' . $file,
          'Line => ' . $line,
          'Error Code => ' . $error['type']
        ],

        'sources' => [
          'Extracted source from #' . $file => $lines
        ]
      ]);
    }
  }}

  register_shutdown_function (
    /**
     * @func Base
     * - Base class for the ils shutdown handler
     * - @version 2.0
     * - @since 1.0.8v
     */
    'Samils\\Handler\\ShutDown\\Base'
  );
}
