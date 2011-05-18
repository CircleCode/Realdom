<?php

/**
 * Hoa
 *
 *
 * @license
 *
 * New BSD License
 *
 * Copyright © 2007-2011, Ivan Enderlin. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Hoa nor the names of its contributors may be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS AND CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace {

from('Hoa')

/**
 * \Hoa\Realdom\Float
 */
-> import('Realdom.Float');

}

namespace Hoa\Realdom {

/**
 * Class \Hoa\Realdom\Boundfloat.
 *
 * Realistic domain: boundfloat.
 *
 * @author     Ivan Enderlin <ivan.enderlin@hoa-project.net>
 * @copyright  Copyright © 2007-2011 Ivan Enderlin.
 * @license    New BSD License
 */

class Boundfloat extends Float {

    /**
     * Realistic domain name.
     *
     * @var \Hoa\Realdom string
     */
    protected $_name = 'boundfloat';

    /**
     * Lower bound value.
     *
     * @var \Hoa\Realdom\Boundfloat int
     */
    protected $_lower = 0;

    /**
     * Upper bound value.
     *
     * @var \Hoa\Realdom\Boundfloat int
     */
    protected $_upper = 0;



    /**
     * Construct a realistic domain.
     *
     * @access  public
     * @param   \Hoa\Realdom\Constinteger  $lower    Lower bound value.
     * @param   \Hoa\Realdom\Constinteger  $upper    Upper bound value.
     * @return  void
     */
    public function construct ( Constinteger $lower = null,
                                Constinteger $upper = null ) {

        if(null === $lower)
            $lower = new Constinteger(~PHP_INT_MAX);

        if(null === $upper)
            $upper = new Constinteger( PHP_INT_MAX);

        $this->_lower = $lower;
        $this->_upper = $upper;

        return;
    }

    /**
     * Predicate whether the sampled value belongs to the realistic domains.
     *
     * @access  public
     * @param   mixed   $q    Sampled value.
     * @return  boolean
     */
    public function predicate ( $q ) {

        return    parent::predicate($q)
               && $q >= $this->getLower()->getValue()
               && $q <= $this->getUpper()->getValue();
    }

    /**
     * Sample one new value.
     *
     * @access  protected
     * @param   \Hoa\Test\Sampler  $sampler    Sampler.
     * @return  mixed
     */
    protected function _sample ( \Hoa\Test\Sampler $sampler ) {

        return $sampler->getFloat(
            $this->getLower()->sample($sampler),
            $this->getUpper()->sample($sampler)
        );
    }

    /**
     * Get the lower bound value.
     *
     * @access  public
     * @return  int
     */
    public function getLower ( ) {

        return $this->_lower;
    }

    /**
     * Get the upper bound value.
     *
     * @access  public
     * @return  int
     */
    public function getUpper ( ) {

        return $this->_upper;
    }
}

}