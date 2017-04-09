<?php

namespace EasyPNR\Tests;

use EasyPNR\ExceptionFactory;
use EasyPNR\Exceptions\AccessDeniedException;
use EasyPNR\Exceptions\Exception;
use EasyPNR\Exceptions\MaxRequestsException;
use EasyPNR\Exceptions\UnrecognizedFormatException;
use EasyPNR\Tests\Mocks\RequestExceptionFactory;
use PHPUnit\Framework\TestCase;

class ExceptionFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function access_denied_exception_should_be_thrown()
    {
        $occurred = RequestExceptionFactory::make(
            403,
            ['message' => 'Access Denied']
        );

        $actual = ExceptionFactory::make($occurred);

        $this->assertInstanceOf(AccessDeniedException::class, $actual);
    }

    /**
     * @test
     */
    public function unrecognized_format_exception_should_be_thrown()
    {
        $occurred = RequestExceptionFactory::make(
            500,
            ['message' => 'Information couldn\'t be decoded.']
        );

        $actual = ExceptionFactory::make($occurred);

        $this->assertInstanceOf(UnrecognizedFormatException::class, $actual);
    }

    /**
     * @test
     */
    public function max_requests_exception_should_be_thrown()
    {
        $occurred = RequestExceptionFactory::make(
            500,
            ['message' => 'You reached maximum request per account']
        );

        $actual = ExceptionFactory::make($occurred);

        $this->assertInstanceOf(MaxRequestsException::class, $actual);
    }

    /**
     * @test
     */
    public function general_pnr_exception_should_be_thrown()
    {
        $actual = ExceptionFactory::make(new \Exception("Something happened"));

        $this->assertInstanceOf(Exception::class, $actual);
    }
}
