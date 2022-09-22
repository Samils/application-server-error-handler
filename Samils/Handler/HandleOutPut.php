<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Samils\Handler\HandleOutPut
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
namespace Samils\Handler {
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!class_exists ('Samils\Handler\HandleOutPut')){
  /**
   * @class HandleOutPut
   * Base internal class for the
   * HandleOutPut module.
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
  class HandleOutPut {
    /**
     * Samils\Functions
     * @version 1.0
     * @author Sammy
     *
     * @keywords Samils, ils, ils-global-functions
     * ------------------------------------
     * - Autoload, application dependencies
     *
     * Make sure the command base internal function is not
     * declared in the php global scope defore creating
     * it.
     * It ensures that the script flux is not interrupted
     * when trying to run the current command by the cli
     * API.
     * ----
     * @Function Name: path2re
     * @Function Description: Convert a path string to a valid regExp
     * @Function Args: $path = null
     *
     * @version 1.0
     *
     * THE CURRENT ILS FUNCTION IS PROVIDED
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
    public static function path2re ($path = null) {
      $specialCharsList = '/[\/\^\$\[\]\{\}\(\)\\\\.]/';

      return preg_replace_callback (
        $specialCharsList, function ($match) {
          return '\\' . $match[0];
      }, (string)$path);
    }

    /**
     * Samils\Functions
     * @version 1.0
     * @author Sammy
     *
     * @keywords Samils, ils, ils-global-functions
     * ------------------------------------
     * - Autoload, application dependencies
     *
     * Make sure the command base internal function is not
     * declared in the php global scope defore creating
     * it.
     * It ensures that the script flux is not interrupted
     * when trying to run the current command by the cli
     * API.
     * ----
     * @Function Name: path2regExp
     * @Function Description: Convert a path string to a valid regExp
     * @Function Args: $path = null
     *
     * @version 1.0
     *
     * THE CURRENT ILS FUNCTION IS PROVIDED
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
    public static function path2regExp ($path = null) {
      return '/' . self::path2re ($path) . '/';
    }

    /**
     * Samils\Functions
     * @version 1.0
     * @author Sammy
     *
     * @keywords Samils, ils, ils-global-functions
     * ------------------------------------
     * - Autoload, application dependencies
     *
     * Make sure the command base internal function is not
     * declared in the php global scope defore creating
     * it.
     * It ensures that the script flux is not interrupted
     * when trying to run the current command by the cli
     * API.
     * ----
     * @Function Name: publicMetaTags
     * @Function Description: get a list of public and global meta tags
     * @Function Args:
     *
     * @version 1.0
     *
     * THE CURRENT ILS FUNCTION IS PROVIDED
     * TO AID THE DEVELOPMENT PROCESS IN ORDER
     * IT GET IN THE SAME WAY WHEN MOVING IT FROM
     * ANOTHER TO ANOTHER ENVIRONMENT.
     *
     * Note: on condition that this is an automatically
     * generated file, it should not be directly changed
     * without saving whole the changes into the original
     * repository source.
     *
     * @author Agostinho Sam'l
     * @keywords public, meta tagsj
     */
    public static function publicMetaTags () {
      $metaTagsFile = join (DIRECTORY_SEPARATOR, [
        self::GetPublicPath (), 'metas.php'
      ]);
      $metas = require ($metaTagsFile);
      $meta_tags = array ();

      if (is_array ($metas) && $metas) {
        foreach ($metas as $index => $attrs) {
          $attributesList = self::stringifyHtmlAttributesList ($attrs);

          array_push ( $meta_tags,
            '<meta ' . $attributesList . ' />'
          );
        }
      }

      return join ( '', $meta_tags );
    }

    /**
     * Samils\Functions
     * @version 1.0
     * @author Sammy
     *
     * @keywords Samils, ils, ils-global-functions
     * ------------------------------------
     * - Autoload, application dependencies
     *
     * Make sure the command base internal function is not
     * declared in the php global scope defore creating
     * it.
     * It ensures that the script flux is not interrupted
     * when trying to run the current command by the cli
     * API.
     * ----
     * @Function Name: publicStyleSheets
     * @Function Description: get the public ils styles
     * @Function Args:
     *
     * @version 1.0
     *
     * THE CURRENT ILS FUNCTION IS PROVIDED
     * TO AID THE DEVELOPMENT PROCESS IN ORDER
     * IT GET IN THE SAME WAY WHEN MOVING IT FROM
     * ANOTHER TO ANOTHER ENVIRONMENT.
     *
     * Note: on condition that this is an automatically
     * generated file, it should not be directly changed
     * without saving whole the changes into the original
     * repository source.
     *
     * @author Agostinho Sam'l
     * @keywords styles, public
     */
    public static function publicStyleSheets () {
      $stylesFile = join (DIRECTORY_SEPARATOR, [
        self::GetPublicPath (), 'styles.css'
      ]);

      if (!is_file ($stylesFile)) {
        return null;
      }

      $styles = file_get_contents ($stylesFile);
      return preg_replace ('/\s+/', ' ', $styles );
    }

    /**
     * Make sure the command base internal function is not
     * declared in the php global scope defore creating
     * it.
     * It ensures that the script flux is not interrupted
     * when trying to run the current command by the cli
     * API.
     * ----
     * @Function Name: stringify_html_attributes_list
     * @Function Description: Stringify Html Attributes List
     * @Function Args: $attributes = null
     *
     * @version 1.0
     *
     * THE CURRENT ILS FUNCTION IS PROVIDED
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
    public static function stringifyHtmlAttributesList ($attributes = null) {
      if (!(is_array($attributes) && $attributes))
        return null;

      $StringifiedAttribute = '';

      foreach ($attributes as $name => $value) {

        $areScalar = ( boolean ) (
          is_array ($value) &&
          self::areScalar ($value)
        );

        if ( $areScalar ) {
          $StringifiedAttribute .= $name.'="'. join($value, ', ') .'" ';
        } else {

          $val = self::stringify ( $value );

          $StringifiedAttribute .= $name.'="'. $val .'" ';
        }
      }

      return preg_replace ('/(\s+)$/', '',
        $StringifiedAttribute
      );
    }

    /**
     * Samils\Functions
     * @version 1.0
     * @author Sammy
     *
     * @keywords Samils, ils, ils-global-functions
     * ------------------------------------
     * - Autoload, application dependencies
     *
     * Make sure the command base internal function is not
     * declared in the php global scope defore creating
     * it.
     * It ensures that the script flux is not interrupted
     * when trying to run the current command by the cli
     * API.
     * ----
     * @Function Name: areScalar
     * @Function Description: validate scalar value from an array
     * @Function Args: array $values
     *
     * @version 1.0
     *
     * THE CURRENT ILS FUNCTION IS PROVIDED
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
    public static function areScalar (array $values = null) {
      if (!(count ($values) >= 1)) return false;

      foreach ($values as $value)
        if (!is_scalar ($value))
          return false;

      return true;
    }

    /**
     * Samils\Functions
     * @version 1.0
     * @author Sammy
     *
     * @keywords Samils, ils, ils-global-functions
     * ------------------------------------
     * - Autoload, application dependencies
     *
     * Make sure the command base internal function is not
     * declared in the php global scope defore creating
     * it.
     * It ensures that the script flux is not interrupted
     * when trying to run the current command by the cli
     * API.
     * ----
     * @Function Name: stringify
     * @Function Description: convert any given value to string
     * @Function Args: mixed $value = null
     *
     * @version 1.0
     *
     * THE CURRENT ILS FUNCTION IS PROVIDED
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
    public static function stringify ($value = null) {
      if (in_array (gettype ($value), ['array', 'object'])){
        return json_encode ($value);
      } else {
        if (is_bool ($value)) {
          return $value ? 'true' : 'false';
        } else {
          return ((string)($value));
        }
      }
    }

    /**
     * Samils\Functions
     * @version 1.0
     * @author Sammy
     *
     * @keywords Samils, ils, ils-global-functions
     * ------------------------------------
     * - Autoload, application dependencies
     *
     * Make sure the command base internal function is not
     * declared in the php global scope defore creating
     * it.
     * It ensures that the script flux is not interrupted
     * when trying to run the current command by the cli
     * API.
     * ----
     * @Function Name: stringify
     * @Function Description: convert any given value to string
     * @Function Args: mixed $value = null
     *
     * @version 1.0
     *
     * THE CURRENT ILS FUNCTION IS PROVIDED
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
    public static function GetPublicPath () {
      return join (DIRECTORY_SEPARATOR, [
        dirname (dirname (__DIR__)), 'public'
      ]);
    }

    /**
     * Samils\Functions
     * @version 1.0
     * @author Sammy
     *
     * @keywords Samils, ils, ils-global-functions
     * ------------------------------------
     * - Autoload, application dependencies
     *
     * Make sure the command base internal function is not
     * declared in the php global scope defore creating
     * it.
     * It ensures that the script flux is not interrupted
     * when trying to run the current command by the cli
     * API.
     * ----
     * @Function Name: array_stringify
     * @Function Description: stringify a given array
     * @Function Args: array $array
     *
     * @version 1.0
     *
     * THE CURRENT ILS FUNCTION IS PROVIDED
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
    public static function array_stringify (array $array = null) {
      if (!(is_array($array) && $array)) {
        return '[]';
      }
      /**
       * [$final_str The final string to be generated]
       * @var string
       */
      $final_str = '[';

      foreach ($array as $key => $val) {
        $keyValue = "'$key' => ";

        if (is_bool($val))
          $v = $val ? 'true' : 'false';
        elseif (is_numeric($val))
          $v = $val;
        elseif (is_string($val))
          $v = ('\'' . preg_replace('/\\\'/', '\'', $val) . '\'');
        elseif (is_array($val))
          $v = self::array_stringify($val);
        else
          $v = '\''.json_encode($val).'\'';

        $final_str .= $keyValue . ($v ? $v : 'null') . ',';
      }

      return (preg_replace('/(,\s*)$/', '', $final_str) .
        ']'
      );
    }
  }}
}
