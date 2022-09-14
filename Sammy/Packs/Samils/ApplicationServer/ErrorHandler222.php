<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\Samils\ApplicationServer
 * - Autoload, application dependencies
 *
 * MIT License
 *
 * Copyright (c) 2020 Ysare
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Sammy\Packs\Samils\ApplicationServer {
  use Samils\Handler\HandleOutPut;
  use Samils\Handler\ConsoleError;
  use Sammy\Packs\TraceDatas;
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!class_exists('Sammy\Packs\Samils\ApplicationServer\ErrorHandler')){
  /**
   * @class ErrorHandler
   * Base internal class for the
   *\Samils\ApplicationServer module.
   * -
   * This is (in the ils environment)
   * an instance of the php module,
   * wich should contain the module
   * core functionalities that should
   * be extended.
   * -
   * For extending the module, just create
   * an 'exts' directory in the module directory
   * and boot it by using the ils directory boot.
   * -
   */
  class ErrorHandler {
    use ErrorHandler\Base;

    public static final function HanldeError () {
      if (!(func_num_args () >= 1)) return;

      $___errorProperties = func_get_arg (0);

      // Command Body
      if (is_array ($___errorProperties)) {
        $re = '/^([a-zA-Z_])([a-zA-Z0-9_]*)$/i';

        foreach ($___errorProperties as $var => $val) {
          if (preg_match ($re, $var)) {
            $$var = $val;
          }
        }
      }

      if (ob_get_length() >= 1) {
        ob_clean ();
      }

      $responseStatus = 500;

      if (isset ($err) && $err instanceof Error) {
        if (isset ($err->status) &&
          is_numeric ($err->status)) {
          $responseStatus = (int)($err->status);
        }
      }

      # Verify if a '$sources' var is an valid
      # array; if it is not, make sure to reasign it
      # with a new value whish should be the value of the
      # '$source' vaariable if that is already declared.
      if (!(isset ($sources) && is_array ($sources) && $sources)) {

        if (isset ($source) && $source instanceof TraceDatas) {
          $lines_high = [$source->line];
          $source = [$source->file, [$source->line, 6]];
        }

        # Make sure '$source' is declared as a valid array
        # before reasign '$sources' with its value.
        if (isset ($source) && is_array ($source) && $source) {
          $contentGetter = requires ('file-content-getter');
          $fileName = (string)$source [0];

          $fileSource = call_user_func_array (
            [$contentGetter, 'getFileLines'], $source
          );

          $sources = [
            "Extracted source from: #{$fileName}" => $fileSource
          ];
        }
      }

      if (!!(isset ($paragraphes) &&
        $paragraphes instanceof TraceDatas)) {
        $paragraphes = [
          join (' => ', ['File', $paragraphes->file]),
          join (' => ', ['Line', $paragraphes->line])
        ];
      }

      http_response_code ($responseStatus);

      if (strtolower(php_sapi_name()) === 'cli') {
        ConsoleError::Handle ( $err, $___errorProperties );
      } else {

        $publicPath = HandleOutPut::GetPublicPath ();
        $indexFileRef = [$publicPath, 'index.php'];

        include join (DIRECTORY_SEPARATOR, $indexFileRef);
      }

      exit (0);
    }
  }}
}
