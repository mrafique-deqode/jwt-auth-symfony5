<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function index(Request $request, ValidatorInterface $validator, UserRepository $userRepository)
    {


        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        $user1 = $userRepository->findOneBy([
            'email' => $user->getEmail(),
        ]);

        if (!is_null($user1)) {
            $res = array("message"=>"User already exists");
            return new Response(json_encode($res));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            // $validatePassword = $validator->validate($user->getPassword());
            $pattern = '/^(?=.*[_])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
            if(preg_match($pattern, $user->getPassword())){
                // Encode the new users password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // Set their role
            $user->setRoles(['ROLE_USER']);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_login');
             } else {
                // throw new \Exception('Password should be minimum of length 8 and should not end with underscore');
                $res = array("message"=>"Password should be minimum of length 8 and should not end with underscore");
                return new Response(json_encode($res));
             }
            
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}