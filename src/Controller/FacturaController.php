<?php

namespace App\Controller;

use App\Entity\Factura;
use App\Form\FacturaType;
use App\Repository\FacturaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
#[Route('/factura')]
class FacturaController extends AbstractController
{
    #[Route('/', name: 'app_factura_index', methods: ['GET'])]
    public function index(FacturaRepository $facturaRepository): Response
    {
        return $this->render('factura/index.html.twig', [
            'facturas' => $facturaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_factura_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FacturaRepository $facturaRepository): Response
    {
        $factura = new Factura();
        $form = $this->createForm(FacturaType::class, $factura);
        $form->handleRequest($request);
        
        /*
        Fórmula para calcula el 21% de un número
        21/100 * x
        */
         
/**Hacer una factura :
 * https://www.infoautonomos.com/facturas/como-hacer-una-factura/
 * 
 */

        if ($form->isSubmitted() && $form->isValid()) {
            $IVAporcentaje= $factura->getIva();
            $IRPFporcentaje= $factura->getIrpf();
            $Cantidadbaseimponible= $factura->getCantidadbaseimponible();
            $IVacantidad= $factura->getIva()/100*$Cantidadbaseimponible ;
            $IRPFcantidad=$factura->getIrpf()/100*$Cantidadbaseimponible;
            $Totalfactura=$Cantidadbaseimponible-$IRPFcantidad;
            $Totalfactura=$Totalfactura+$IVacantidad;
        /*Restult test*/
            dump($IRPFcantidad);
            dump($IVacantidad);
            dump($IVAporcentaje);

            dump($IRPFporcentaje);
            dump($IRPFcantidad);
            dump($Cantidadbaseimponible);
            dump($Totalfactura);
            $factura->setTotalfactura($Totalfactura);           
            $facturaRepository->save($factura, true);

            return $this->redirectToRoute('app_factura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('factura/new.html.twig', [
            'factura' => $factura,
            'form' => $form,
        ]);
    }

    //generar pdf (de factura ):


    #[Route('/{id}/pdfgenfac', name: 'app_diagnostico_pdfgenfac', methods: ['GET', 'POST'])]
    public function pdfgenfac(Request $request, Factura $factura): Response
    {
        $Cantidadbaseimponible=$factura->getCantidadbaseimponible();
        $IVacantidad= $factura->getIva()/100*$Cantidadbaseimponible ;
        $IRPFcantidad=$factura->getIrpf()/100*$Cantidadbaseimponible;
        $Totalfactura=$Cantidadbaseimponible-$IRPFcantidad;
        $Totalfactura=$Totalfactura+$IVacantidad;

        $data = [
            'numerofactura'=>$factura->getNumerofactura() ,
            'imageSrc'  => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/images/sf.png'),
            'name'         =>$factura->getPaciente(),
            'date'      => $factura->getDatefactura(),
            'iva'=>$factura-> getIva(),
            'irpf'=>$factura->getIrpf(),
            'cantidadbaseimponible'=>$factura->getCantidadbaseimponible(),
            'IVacantidad'=>$IVacantidad,
            'IRPFcantidad'=>$IRPFcantidad,
            'totalfactura'=>$Totalfactura

        ];
  
        $html =  $this->renderView('factura/pdffactura.html.twig', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
         
        return new Response (
            $dompdf->stream('resume', ["Attachment" => false]),
            Response::HTTP_OK,
            ['Content-Type' => 'application/pdf']
        );
    
    }
    
    private function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    

    #[Route('/{id}', name: 'app_factura_show', methods: ['GET'])]
    public function show(Factura $factura): Response
    {
        return $this->render('factura/show.html.twig', [
            'factura' => $factura,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_factura_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Factura $factura, FacturaRepository $facturaRepository): Response
    {
        $form = $this->createForm(FacturaType::class, $factura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $facturaRepository->save($factura, true);

            return $this->redirectToRoute('app_factura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('factura/edit.html.twig', [
            'factura' => $factura,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_factura_delete', methods: ['POST'])]
    public function delete(Request $request, Factura $factura, FacturaRepository $facturaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$factura->getId(), $request->request->get('_token'))) {
            $facturaRepository->remove($factura, true);
        }

        return $this->redirectToRoute('app_factura_index', [], Response::HTTP_SEE_OTHER);
    }
}
