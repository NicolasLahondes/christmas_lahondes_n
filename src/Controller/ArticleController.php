<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/article")
 */
class ArticleController extends AbstractController
{

// Display all Articles

    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {

        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

// Create a new Article

    /**
     * @Route("/new", name="article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SluggerInterface $slugger): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // Error management
            $errors = $validator->validate($article);
            if (count($errors) > 0) {
                return $this->render('author/validation.html.twig', [
                    'errors' => $errors,
                ]);
            }
            // image modification/upload management
            if (!empty($form->get('picturemain'))) {
                /** @var UploadedFile $imagesFile */
                $imagesFile = $form->get('picturemain')->getData();
                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($imagesFile) {
                    $originalFilename = pathinfo($imagesFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imagesFile->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $imagesFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $article->setPicturemain($newFilename);
                }
            }
            if (!empty($form->get('picturefront'))) {
                /** @var UploadedFile $imagesFile */
                $imagesFile = $form->get('picturefront')->getData();
                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($imagesFile) {
                    $originalFilename = pathinfo($imagesFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imagesFile->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $imagesFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $article->setPicturefront($newFilename);
                }
            }
            if (!empty($form->get('pictureback'))) {
                /** @var UploadedFile $imagesFile */
                $imagesFile = $form->get('pictureback')->getData();
                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($imagesFile) {
                    $originalFilename = pathinfo($imagesFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imagesFile->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $imagesFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $article->setPictureback($newFilename);
                }
            }
            if (!empty($form->get('manual')))
                $brochureFile = $form->get('manual')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $article->setManual($newFilename);
            }
            if ($form->isValid()) {
                $entityManager->persist($article);
                $entityManager->flush();
            }
            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

// Display one article

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

// Edit one article

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager, ValidatorInterface $validator, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            // Error management
            $errors = $validator->validate($article);
            if (count($errors) > 0) {
                return $this->render('author/validation.html.twig', [
                    'errors' => $errors,
                ]);
            }

            // image modification/upload management
            if (!empty($form->get('picturemain'))) {
                /** @var UploadedFile $imagesFile */
                $imagesFile = $form->get('picturemain')->getData();
                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($imagesFile) {
                    $originalFilename = pathinfo($imagesFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imagesFile->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $imagesFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $article->setPicturemain($newFilename);
                }
            }
            if (!empty($form->get('picturefront'))) {
                /** @var UploadedFile $imagesFile */
                $imagesFile = $form->get('picturefront')->getData();
                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($imagesFile) {
                    $originalFilename = pathinfo($imagesFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imagesFile->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $imagesFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $article->setPicturefront($newFilename);
                }
            }
            if (!empty($form->get('pictureback'))) {
                /** @var UploadedFile $imagesFile */
                $imagesFile = $form->get('pictureback')->getData();
                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($imagesFile) {
                    $originalFilename = pathinfo($imagesFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imagesFile->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $imagesFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $article->setPictureback($newFilename);
                }
            }
            if (!empty($form->get('manual')))
                $brochureFile = $form->get('manual')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $article->setManual($newFilename);
            }

            if ($form->isValid()) {
                $entityManager->flush();
                return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

// Delete one article

    /**
     * @Route("/{id}", name="article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
    }
}
