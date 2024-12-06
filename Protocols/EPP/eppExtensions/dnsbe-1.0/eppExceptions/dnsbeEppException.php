<?php

namespace Metaregistrar\EPP;

use Exception;

/**
 * <epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:dnsbe="http://www.dns.be/xml/epp/dnsbe-1.0">
 *   <response>
 *     <result code="2308">
 *       <msg>Data management policy violation</msg>
 *     </result>
 *     <extension>
 *       <dnsbe:ext>
 *         <dnsbe:result>
 *           <dnsbe:msg>domain [example] has invalid status</dnsbe:msg>
 *         </dnsbe:result>
 *       </dnsbe:ext>
 *     </extension>
 *     <trID>
 *       <clTRID>6751bf76adf8c</clTRID>
 *       <svTRID>dnsbe-4761557</svTRID>
 *     </trID>
 *   </response>
 * </epp>.
 */
/**
 * Class dnsbeEppException.
 */
class dnsbeEppException extends eppException
{
    /**
     * @var eppResponse
     */
    private $eppresponse;

    public function __construct($message = '', $code = 0, ?Exception $previous = null, $reason = null, $command = null)
    {
        if ($command) {
            $this->eppresponse = new eppResponse();
            $this->eppresponse->loadXML($command);
        }
        parent::__construct($message, $code, $previous, $reason, $command);
    }

    public function getDnsbeErrorMessage()
    {
        return $this->eppresponse->queryPath('/epp:epp/epp:response/epp:extension/dnsbe:ext/dnsbe:result/dnsbe:msg');
    }
}
