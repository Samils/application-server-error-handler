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
  use Samils\Handler\Error;
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!class_exists('Sammy\Packs\Samils\ApplicationServer\ConsoleErrorHandler')){
  /**
   * @class ConsoleErrorHandler
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
  class ConsoleErrorHandler {
    /**
     * @version 1.0
     *
     * THE CURRENT FUNCTION FUNCTION IS PROVIDED
     * TO AID THE DEVELOPMENT PROCESS IN ORDER
     * IT GET IN THE SAME WAY WHEN MOVING IT FROM
     * ANOTHER TO ANOTHER ENVIRONMENT.
     *
     * Note: on condition that this is an automatically
     * generated file, it should not be directly changed
     * without saving whole the changes into the original
     * repository source.
     *
     * @author SAML
     * @keywords error-handler, handler, error
     */
    public static function Handle (Error $error, array $errorProps = []) {
      $title = isset($errorProps ['title']) ? $errorProps ['title'] : (
        'Error'
      );

      $message = isset($error->message) ? $error->message : (
        'Something is wrong..!'
      );

      $paragraphes = isset($errorProps ['paragraphes']) ? $errorProps ['paragraphes'] : (
        []
      );

      if (!is_array ($paragraphes)) {
        $paragraphes = [];
      }

      $trace = debug_backtrace();

      $errorContentBody = join ('', array (
        "\033[31m\n# {$title}\033[0m\n\n",
        "\033[41m\033[30m - {$message}\n\n\n",
        "\033[0m \033[0m \n", join ("\n\n", $paragraphes),
        "\n\n\n"
      ));

      exit ( $errorContentBody );
    }
  }}
}
